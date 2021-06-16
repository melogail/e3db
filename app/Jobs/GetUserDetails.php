<?php

namespace App\Jobs;

use App\Exports\FbUsersExport;
use App\Models\Django\FbUser;
use App\Models\SearchLog;
use App\traits\UsersDetails;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class GetUserDetails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, UsersDetails;


    /**
     * Holds users array got from request.
     *
     * @var FbUser
     */
    protected $users;


    /**
     * Authenticated agent
     *
     * @var
     */
    protected $agent;


    /**
     * Search type "group" or "post"
     *
     * @var
     */
    protected $search_type;


    /**
     * CSV file to be sent
     *
     * @var null
     */
    protected $file = null;


    /**
     * CSV file name to be sent
     *
     * @var null
     */
    protected $file_name = null;


    /**
     * Holds the users details.
     *
     * @var
     */
    protected $result = [];


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($users, $agent, $search_type)
    {
        $this->users = $users;
        $this->agent = $agent;
        $this->search_type = $search_type;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->users as $user) {
            $user = json_decode(json_encode($user, JSON_UNESCAPED_UNICODE));

            if ($user->user_id != null) {
                $u = FbUser::where('fb_id', $user->user_id)->first(['fb_id', 'user_name', 'mobile', 'name', 'position', 'location', 'hometown']);
            } else if ($user->user_username != null) {
                $u = FbUser::where('user_name', $user->user_username)->first(['fb_id', 'user_name', 'mobile', 'name', 'position', 'location', 'hometown']);
            }

            if ($u != null) {
                // Adding collections to array for extracting to CSV
                array_push($this->result, $u->toArray());
                SearchLog::create(['user_id' => $this->agent['id'], 'type' => $this->search_type, 'search_query' => $u->fb_id ?? $u->user_name]);
            }
        }

        $file_name = $this->agent['id'] . '_'.Carbon::now()->timestamp . '.xlsx';
        $file = Excel::store((new FbUsersExport($this->result)), 'exports/' . $file_name);

        if ($file) {
            $to_name = $this->agent['first_name'] . ' ' . $this->agent['last_name'];
            $to_email = $this->agent['email'];
            $email_data = ['name' => $this->agent['first_name'] . ' ' . $this->agent['last_name'], 'body' => 'Kindly find your attached CSV file.'];
            Mail::send('emails/confirm', $email_data, function($message) use ($to_name, $to_email, $file_name){
                $message->to($to_email, $to_name)->subject('Facebook users data CSV file');
                $message->from('noreply@e3businessdatabase.com', 'E3mel Business Database');
                $message->attach(storage_path('app/exports/' . $file_name));
            });
        }
    }

    /**
     * Return users response.
     *
     * @return mixed
     */
    public function getResponse()
    {
        return $this->result;
    }
}

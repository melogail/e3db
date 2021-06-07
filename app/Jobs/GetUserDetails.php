<?php

namespace App\Jobs;

use App\Models\Django\FbUser;
use App\Models\SearchLog;
use App\traits\UsersDetails;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;

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
     * Holds the users details.
     *
     * @var
     */
    protected $response = [];

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
        // Allow only 10 tasks every 1 second.
        Redis::throttle('getUsersDetails')->allow(10)->every(60)->then(function (){
            foreach ($this->users as $user) {
                $user = json_decode(json_encode($user, JSON_UNESCAPED_UNICODE));

                if ($user->user_id != null) {
                    $u = FbUser::where('fb_id', $user->user_id)->first(['fb_id', 'user_name', 'mobile', 'name', 'position', 'location', 'hometown']);
                } else if ($user->user_username != null) {
                    $u = FbUser::where('fb_id', $user->user_username)->first(['fb_id', 'user_name', 'mobile', 'name', 'position', 'location', 'hometown']);
                }

                if ($u != null) {
                    array_push($this->response, $u->toJson(JSON_UNESCAPED_UNICODE));
                    SearchLog::create(['user_id' => $this->agent['id'], 'type' => $this->search_type, 'search_query' => $u->fb_id ?? $u->user_name]);
                }
            }

        }, function(){

            // Could not obtain lock; this job will be re-queued.
            return $this->release(2);
        });
    }

    /**
     * Return users response.
     *
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }
}

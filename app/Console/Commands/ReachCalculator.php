<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use WhosThere\TwitterClient\TwitterClientInterface;

class ReachCalculator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reach:calculate {url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is an awesome description you would only read if you actually read this assessment. Thanks for spending time checking my work!';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param TwitterClientInterface $client
     */
    public function handle(TwitterClientInterface $client)
    {
        $url = $this->argument('url');

        if($this->isValidUrl($url))
        {
            $client->placeholder('test');
        } else {
            $this->error('Url is not a valid url');
        }
    }

    /**
     * @param $url
     * @return mixed
     */
    private function isValidUrl($url)
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }
}

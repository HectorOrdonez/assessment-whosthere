<?php

namespace WhosThere\ReachCalculator\Command;

use Illuminate\Console\Command;
use WhosThere\TwitterClient\TwitterClientInterface;

class ReachCalculatorCommand extends Command
{
    const MESSAGE = 'This tweet has reached %d people';
    const ERROR_INVALID_URL = 'Url is not a valid url';

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
            $reach = $client->placeholder($url);

            $this->info(sprintf(self::MESSAGE, $reach));
        } else {
            $this->error(self::ERROR_INVALID_URL);
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

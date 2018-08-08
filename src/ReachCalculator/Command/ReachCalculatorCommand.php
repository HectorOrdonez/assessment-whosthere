<?php

namespace WhosThere\ReachCalculator\Command;

use Illuminate\Console\Command;
use WhosThere\ReachCalculator\ReachCalculatorServiceInterface;
use WhosThere\ReachCalculator\Service\ReachCalculator;
use WhosThere\Twitter\Exception\TwitterClientException;
use WhosThere\Twitter\TwitterClientInterface;

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
     * Execute the console command.
     *
     * @param ReachCalculatorServiceInterface $calculator
     */
    public function handle(ReachCalculatorServiceInterface $calculator)
    {
        $url = $this->argument('url');

        if ($this->isValidUrl($url)) {
            $this->runService($calculator, $url);
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

    /**
     * @param ReachCalculatorServiceInterface $calculator
     * @param \Symfony\Component\Console\Output\OutputInterface $url
     * @return mixed|void
     */
    private function runService(ReachCalculatorServiceInterface $calculator, $url)
    {
        try {
            $reach = $calculator->calculate($url);

            $this->info(sprintf(self::MESSAGE, $reach));

        } catch (TwitterClientException $exception) {
            $this->error($exception->getMessage());
        }
    }
}

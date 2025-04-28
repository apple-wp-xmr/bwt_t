<?php

namespace App\Services;

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class WeatherParserService
{
    protected Client $http;
    protected Crawler $crawler;

    public function __construct()
    {
        $this->http    = new Client(['timeout' => 10, 'verify'  => false]);
        $this->crawler = new Crawler();
    }

    /**
     * Fetch “now” weather from meteofor.com.ua for Zaporizhia
     *
     * @return array{place: string, temperature: string}
     * @throws \Exception
     */
    public function parseNow(): array
    {
        $url = 'https://meteofor.com.ua/ru/weather-zaporizhia-5093/now/';
        $res = $this->http->get($url);

        if ($res->getStatusCode() !== 200) {
            throw new \Exception("Failed to fetch weather page, status {$res->getStatusCode()}");
        }

        $html = (string) $res->getBody();

        // load HTML into crawler
        $this->crawler->clear();
        $this->crawler->addHtmlContent($html);

        $widget = $this->crawler->filter('body main .section-bottom-shadow .widget.now')->first();

        $temperature = $widget
            ->filter('.now-weather > temperature-value')
            ->first()
            ->attr('value');

        $infoItems = $widget->filter('.now-info .info-wrap .now-info-item');

        //  wind = eq(0)
        $wind = $infoItems
            ->eq(0)
            ->filter('speed-value')
            ->first()
            ->attr('value');

        //  pressure = eq(1)
        $pressure = $infoItems
            ->eq(1)
            ->filter('pressure-value')
            ->first()
            ->attr('value');

        //  humidity = eq(2)
        $humidity = $infoItems
            ->eq(2)
            ->filter('.item-value')
            ->first()
            ->text('', false);


        return [
            'temperature' => trim($temperature),
            'wind'        => trim($wind),
            'pressure'    => trim($pressure),
            'humidity'    => trim($humidity),
        ];
    }
}

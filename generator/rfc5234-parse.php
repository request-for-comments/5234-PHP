<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

require_once __DIR__ . '/../vendor/autoload.php';

$ch = curl_init('https://tools.ietf.org/rfc/rfc5234.txt');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

$doc = curl_exec($ch);

$doc = preg_replace('#(\r\n|\n)#', "\r\n", $doc);

dump($doc);

$regex = \RFC5234\Helper\RegexHelper::prepare('(' . \RFC5234\Rule\Rule::getPattern() . ')', \RFC5234\Helper\RegexHelper::NO_ANCHORS);

$regex->pregMatchAll($doc, $matches);

dump($matches[0]);

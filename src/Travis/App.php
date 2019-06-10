<?php

namespace Travis;

use Travis\CLI;
use Travis\Date;

class App
{
	public static function run()
	{
		// set year
		$year_start = 1996;
		$year_stop = 2018;

		// get dates
		$dates = static::get_dates($year_start, $year_stop);

		// foreach date...
		foreach ($dates as $key => $date)
		{
			// make date
			$d = Date::make($date);

			// submit for download
			static::download($d->format('%Y'), $d->format('%m'), $d->format('%d'));
		}

		// report
		CLI::write('Done.');
	}

	protected static function get_dates($year_start, $year_stop)
	{
		// init
		$dates = [];

		$date_start = Date::make($year_start.'-01-01');
		$date_stop = Date::make(($year_stop+1).'-01-01');

		// while...
		while ($date_start->format('%F') < $date_stop->format('%F'))
		{
			// add to array
			$dates[] = $date_start->format('%F');

			// increment
			$date_start->remake('+1 day');
		}

		// return
		return $dates;
	}

	protected static function download($year, $month, $day)
	{
		// set filename
		$filename = 'phc_'.$year.$month.$day.'_128.mp3';

		// set url
		$url = 'http://167.88.156.221/phc/'.$year.'/'.$month.'/'.$day.'/'.$filename;

		// set path
		$path = path('storage/'.$year.'/'.$filename);

		// report
		CLI::write($url);

		// if not already saved...
		if (!file_exists($path))
		{
			// make dir
			@mkdir(path('storage/'.$year));

			// download file
			$contents = @file_get_contents($url);

			// if found...
			if ($contents)
			{
				// save file
				file_put_contents($path, $contents);

				// report
				CLI::info($path);
			}
		}

		// if file already exists...
		else
		{
			// report
			CLI::error($path);
		}
	}
}
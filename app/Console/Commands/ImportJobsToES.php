<?php

namespace App\Console\Commands;
use App\Models\Job;
use Illuminate\Console\Command;
use Sleimanx2\Plastic\Facades\Plastic;
class ImportJobsToES extends Command
{
	protected $signature = 'ImportJobsToES {offset}';
	protected $description = 'Import jobs to Elastic Search';
	public function __construct()
	{
		parent::__construct();
	}
	public function handle()
	{
		$offset = $this->argument('offset');
		$limit = 300;
		$this->processJobs($offset, $limit);
		$offset += $limit;
		$this->call('ImportJobsToES', ['offset' => $offset]);
	}
	protected function processJobs($min, $max)
	{

		$jobs = Job::offset($offset)->limit($limit)->get();

		if(count($jobs))
		{
			Plastic::persist()->bulkSave($jobs);
			$max = $offset + $limit;
			$this->info("Indexed jobs to ES  from {$offset} to {$max}.");
			unset($jobs);
		}
	}
}
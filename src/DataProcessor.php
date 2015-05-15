<?php

namespace Tomaj\CsvProcessor;

use Symfony\Component\Console\Output\OutputInterface;
use Tomaj\CsvProcessor\Processors\Processor;

class DataProcessor
{
    /** @var \Symfony\Component\Console\Output\OutputInterface */
    private $output;

    /** @var array(Processor) */
    private $processors = array();

    private $pid;

    /** * @var \Symfony\Component\Console\Helper\ProgressBar */
    private $progressBar;

    public function __construct(OutputInterface $output, $progressBar = null, $pid = 0)
    {
        $this->output = $output;
        $this->progressBar = $progressBar;
        $this->pid = $pid;
    }

    public function addProcessor(Processor $processor)
    {
        $this->processors[] = $processor;
    }

    public function processLine($lineArray, $persistLineFunction)
    {
        $line = new Line($lineArray);
        foreach ($this->processors as $processor) {
            $processor->process($line);
        }
        $persistLineFunction($line, $this->pid);
    }

    public function processData($lines, $persistLineFunction)
    {
        $totalLines = count($lines);
        if ($this->progressBar) {
            $this->progressBar->start();
        }
        foreach ($lines as $line) {
            $this->processLine($line, $persistLineFunction);
            if ($this->progressBar) {
                $this->progressBar->advance();
            }
        }
        if ($this->progressBar) {
            $this->progressBar->finish();
        }
        $this->output->writeln('');
        $this->output->writeln("Processed <info>$totalLines</info>");
    }
}

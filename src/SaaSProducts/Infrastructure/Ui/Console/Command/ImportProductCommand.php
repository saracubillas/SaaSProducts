<?php

namespace SaaSProducts\Infrastructure\Ui\Console\Command;

use SaaSProducts\Domain\Model\Importer;
use SaaSProducts\Domain\Model\CapterraParser;
use SaaSProducts\Domain\Model\SoftwareAdviceParser;
use SaaSProducts\Infrastructure\Persistence\InMemory\ProductRepository;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ImportProductCommand extends Command
{
    const CAPTERRA = 'capterra';
    const SOFTWAREADVICE = 'softwareadvice';
    private $repository;
    private $parser;
    private $importer;

    protected function configure()
    {
        $this
            ->setName('import:product')
            ->setDescription('Product importer')
            ->addArgument(
                'type',
                InputArgument::REQUIRED,
                'Which one you want to import?'
            );
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return String
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $this->getArguments($input);
            $this->repository = new ProductRepository();
            $this->importer = new Importer($this->repository, $this->parser);
            $this->importer->import();

        } catch (\Exception $e) {
            $output->writeln($e->getMessage());
        }
    }


    /**
     * @param InputInterface $input
     * @throws \Exception
     */
    protected function getArguments(InputInterface $input)
    {
        $type = $input->getArgument('type');
        if ($type == self::CAPTERRA) {
            $this->parser = new CapterraParser();
        } elseif ($type == self::SOFTWAREADVICE) {
            $this->parser = new SoftwareAdviceParser();
        } else {
            throw new \Exception('invalid type of product provider');
        }
    }
}

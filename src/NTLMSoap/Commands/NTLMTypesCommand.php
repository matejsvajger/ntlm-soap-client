<?php
namespace matejsvajger\NTLMSoap\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use matejsvajger\NTLMSoap\Client;

/**
 * Console command to list available functions on the WebService URL.
 */
class NTLMTypesCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('ntlm:types')
            ->setDescription('List Object types on service.')
            ->addArgument(
                'url',
                InputArgument::REQUIRED,
                'WDSL WebService URL: http://<Server>:<WebServicePort>/<ServerInstance>/WS/<CompanyName>/<Service>'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $url = $input->getArgument('url');

        $client = new Client($url);

        $response = $client->getTypes();

        if (!empty($response)) {
            $output->writeln("\n<comment>Available Objects on $url WebService</comment>");
            $text = [];
            foreach ($response as $object) {
                $text[] = "<comment>===</comment>\n<info>$object</info>";
            }
            $output->writeln(implode("\n", $text));
        }
    }
}

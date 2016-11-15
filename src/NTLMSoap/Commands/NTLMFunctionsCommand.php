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
class NTLMFunctionsCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('ntlm:functions')
            ->setDescription('List Available functions on service.')
            ->addArgument(
                'server',
                InputArgument::REQUIRED,
                'WDSL WebService URL: http://<Server>:<WebServicePort>/<ServerInstance>/WS/<CompanyName>'
            )
            ->addArgument(
                'service',
                InputArgument::REQUIRED,
                'Service Path on NAT Server (comes after {/WS/<CompanyName>/} in url).'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $server = $input->getArgument('server');
        $service = $input->getArgument('service');
        $url = trim($server, '/') . '/' . trim($service, '/');

        $client = new Client($url);

        $response = $client->getFunctions();

        if (!empty($response)) {
            $output->writeln("\n<comment>Available Methods on $url WebService</comment>");
            $text = [];
            foreach ($response as $method) {
                $text[] = "  <info>* $method</info>";
            }
            $output->writeln(implode("\n", $text));
        }
    }
}

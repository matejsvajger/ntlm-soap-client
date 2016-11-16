<?php
namespace matejsvajger\NTLMSoap\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use matejsvajger\NTLMSoap\Client;
use matejsvajger\NTLMSoap\Common\NTLMConfig;

/**
 * Console command to perform actions on the WebService URL.
 */
class NTLMServiceCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('ntlm:service')
            ->setDescription('Perfrom an action on the service endpoint.')
            ->addArgument(
                'url',
                InputArgument::REQUIRED,
                'WDSL WebService URL: http://<Server>:<WebServicePort>/<ServerInstance>/WS/<CompanyName>/<Service>'
            )
            ->addArgument(
                'userpass',
                InputArgument::REQUIRED,
                'User/Password string for the NTLM Authentication on the service in format "domain\username:password".'
            )
            ->addArgument(
                'action',
                InputArgument::REQUIRED,
                'WDSL Service Action (fetched from ntlm:functions command)'
            )
            ->addOption(
                'size',
                null,
                InputOption::VALUE_REQUIRED,
                "Limit size of the returned request query. 0 = All, -1 = Reverse Order."
            )
            ->addOption(
                'filter',
                null,
                InputOption::VALUE_REQUIRED,
                "A filter query string of Field=>Criteria pairs based on standard Microsoft Dynamics NAV filter format;\n
                ie: --filter=No,10000..101000;Name,Comp*"
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $url = $input->getArgument('url');
        $userpass = $input->getArgument('userpass');
        $action = $input->getArgument('action');
        $size = $input->getOption('size');

        $domainUserPass = explode('\\', $userpass);
        $domain = array_shift($domainUserPass);
        $userPass = explode(':', array_shift($domainUserPass));
        $username = array_shift($userPass);
        $password = array_shift($userPass);

        $serviceArray = explode('/', $url);
        $serviceEndPoint = array_pop($serviceArray);

        $soapConfig = new NTLMConfig([
            'domain' => $domain,
            'username' => $username,
            'password' => $password
        ]);

        $client = new Client($url, $soapConfig);

        $response = $client->$action(['filter'=>[], 'setSize'=>$size, 'bookmarkKey'=>null]);
        if (!empty($response)) {
            $output->writeln("\n<comment>WebService Response from Action $action:</comment>");
            $text = [];
            foreach ($response->{"{$action}_Result"}->{$serviceEndPoint} as $entity) {
                @$text[] = "  <info>* <comment>$entity->Name</comment>, $entity->Address, $entity->City $entity->Post_Code, $entity->Country_Region_Code</info>";
            }
            $output->writeln(implode("\n", $text));
        }
    }
}

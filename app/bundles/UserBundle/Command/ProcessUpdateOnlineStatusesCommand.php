<?php

/*
 * @copyright   2015 Mautic Contributors. All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace Mautic\UserBundle\Command;

use Mautic\CoreBundle\Command\ModeratedCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * CLI command to check for messages.
 */
class ProcessUpdateOnlineStatusesCommand extends ModeratedCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('mautic:users:offline')
            ->setDescription('Set user offline apfer 15 minutes.')
            ->setHelp(
                <<<'EOT'
                The <info>%command.name%</info> command is used to set user offline if it didn't get updated, it means the user closed their browser and are thus.

<info>php %command.full_name%</info>
EOT
            );
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container  = $this->getContainer();

        /** @var \Mautic\UserBundle\Model\UserModel $userModel */
        $userModel = $container->get('mautic.user.model.user');

        $userModel->getRepository()->updateOnlineStatuses();
        
        $output->writeln('<info>Done</info>');
    }
}

<?php

namespace Mmoreramerino\GearmanBundle\Command;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

/**
 * Gearman Job List Command class
 *
 * @author Marc Morera <yuhu@mmoreram.com>
 */
class GearmanTestFunctionalCommand extends ContainerAwareCommand
{
    /**
     * Console Command configuration
     */
    protected function configure()
    {
        parent::configure();
        $this->setName('gearman:test:functional')
             ->setDescription('Performs all functional tests using real gearman environment');
    }

    /**
     * Executes the current command.
     *
     * @param InputInterface  $input  An InputInterface instance
     * @param OutputInterface $output An OutputInterface instance
     *
     * @return integer 0 if everything went fine, or an error code
     *
     * @throws \LogicException When this abstract class is not implemented
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /**
         * Lets test all kind of job calls
         */
        $output->writeln('');

        $output->writeln('     Testing some functional GearmanBundle features. Written by Marc Morera (2012)');
        $output->writeln('');
        $output->write('     ');

        $gearman = $this->getContainer()->get('gearman');




        $this

        /**
         * Normal jobs
         */
        ->testResult($output, $gearman->doNormalJob('MmoreramerinoGearmanBundleWorkerstestWorker~test'), 'A')
        ->testResult($output, $gearman->doHighJob('MmoreramerinoGearmanBundleWorkerstestWorker~test'), 'A')
        ->testResult($output, $gearman->doLowJob('MmoreramerinoGearmanBundleWorkerstestWorker~testB'), 'B')
        ->testResult($output, $gearman->doNormalJob('MmoreramerinoGearmanBundleWorkerstestWorker~testC'), 'C')
        ->testResult($output, $gearman->callJob('MmoreramerinoGearmanBundleWorkerstestWorker~testB'), 'B')



        /**
         * Background jobs
         */
        ->testBackgroundResult($output, $gearman->doBackgroundJob('MmoreramerinoGearmanBundleWorkerstestWorker~test'))
        ->testBackgroundResult($output, $gearman->doHighBackgroundJob('MmoreramerinoGearmanBundleWorkerstestWorker~testB'))
        ->testBackgroundResult($output, $gearman->doLowBackgroundJob('MmoreramerinoGearmanBundleWorkerstestWorker~testB'));


        $output->writeln('');
        $output->writeln('');
    }




    /**
     * Just print a green star throught output if both values are equals
     *
     * Otherwise a red F is printed
     *
     * @param OutputInterface $output   Output
     * @param mixed           $given    Given value
     * @param mixed           $expected Expected value to compare with
     *
     * @return GearmanTestFunctionalCommand self Object
     */
    protected function testResult(OutputInterface $output, $given, $expected)
    {
        if ($given === $expected) {

            $this->ok($output);
        } else {

            $this->fail($output);
        }

        return $this;
    }


    /**
     * Just print a green star throught output if given value is not blank
     *
     * Otherwise a red F is printed
     *
     * @param OutputInterface $output Output
     * @param mixed           $given  Given value
     *
     * @return GearmanTestFunctionalCommand self Object
     */
    protected function testBackgroundResult(OutputInterface $output, $given)
    {
        if ('' != $given) {

            $this->ok($output);
        } else {

            $this->fail($output);
        }

        return $this;
    }



    /**
     * Just print a green star
     *
     * @param OutputInterface $output Output
     *
     * @return GearmanTestFunctionalCommand self Object
     */
    private function ok(OutputInterface $output)
    {
        $output->write('<info>#</info>');

        return $this;
    }


    /**
     * Just print a red F
     *
     * @param OutputInterface $output Output
     *
     * @return GearmanTestFunctionalCommand self Object
     */
    private function fail(OutputInterface $output)
    {
        $output->write('<error>F</error>');

        return $this;
    }
}
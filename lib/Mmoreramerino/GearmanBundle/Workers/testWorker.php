<?php

namespace Mmoreramerino\GearmanBundle\Workers;

use Mmoreramerino\GearmanBundle\Driver\Gearman;
use Symfony\Component\DependencyInjection\ContainerAware;

/** @Gearman\Work(description="Worker test description", defaultMethod="doHigh") */
class testWorker extends ContainerAware
{

    /**
     * Test method to run as a job
     *
     * @param \GearmanJob $job Object with job parameters
     *
     * @return boolean
     *
     * @Gearman\Job(name="test", description="This is a description", defaultMethod="doLow")
     */
    public function testA(\GearmanJob $job)
    {
        echo 'Job testA done!'.PHP_EOL;

        return 'A';
    }

    /**
     * Test method to run as a job
     *
     * @param \GearmanJob $job Object with job parameters
     *
     * @return boolean
     *
     * @Gearman\Job
     */
    public function testB(\GearmanJob $job)
    {
        echo 'Job testB done!'.PHP_EOL;

        return 'B';
    }

    /**
     * Test method to run as a job
     *
     * @param \GearmanJob $job Object with job parameters
     *
     * @return boolean
     *
     * @Gearman\Job
     */
    public function testC(\GearmanJob $job)
    {
        $container = $this->container;

        $container->get('gearman');

        return 'C';
    }
}

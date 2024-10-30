<?php

namespace Tests\Exercice7;

final class Exercice7Test extends \PHPUnit\Framework\TestCase
{
    public function test_user_fileExists()
    {
        $filename = __DIR__ . '/../../src/User.php';
        $this->assertFileExists($filename);
    }

    public function test_user_classExists()
    {
        $this->assertTrue(class_exists('App\User'));
    }

    public function test_user_objectInstance()
    {
        $user = new \App\User();
        $this->assertInstanceOf(\App\User::class, $user);
    }

    public function test_user_propertiesExist()
    {
        $user = new \App\User();
        $this->assertObjectHasProperty('firstname', $user);
        $this->assertObjectHasProperty('lastname', $user);
        $this->assertObjectHasProperty('birthday', $user);
    }

    public function test_user_settersExistAndHaveSideEffects()
    {
        $user = new \App\User();

        $user->setFirstname('John');
        $this->assertEquals('John', $user->getFirstname());

        $user->setLastname('Doe');
        $this->assertEquals('Doe', $user->getLastname());

        $user->setBirthday(new \DateTime('1990-01-01'));
        $this->assertEquals('1990-01-01', $user->getBirthday()->format('Y-m-d'));
    }

    public function test_dateCalculator_fileExists()
    {
        $filename = __DIR__ . '/../../src/DateCalculator.php';
        $this->assertFileExists($filename);
    }

    public function test_dateCalculator_classExists()
    {
        $this->assertTrue(class_exists('App\DateCalculator'));
    }

    public function test_dateCalculator_objectInstance()
    {
        $dateCalculator = new \App\DateCalculator();
        $this->assertInstanceOf(\App\DateCalculator::class, $dateCalculator);
    }

    public function test_dateCalculator_getDaysBetweenTwoDates_checkResults()
    {
        $dateCalculator = new \App\DateCalculator();
        $dateLeft = new \DateTime('2024-10-31');
        $dateRight = new \DateTime('2024-10-26');

        $this->assertisInt($dateCalculator->getDaysBetweenTwoDates($dateLeft, $dateRight));
        $this->assertEquals(360, $dateCalculator->getDaysBetweenTwoDates($dateLeft, $dateRight));

        $dateLeft = new \DateTime('2024-10-26');
        $dateRight = new \DateTime('2024-10-31');

        $this->assertEquals(5, $dateCalculator->getDaysBetweenTwoDates($dateLeft, $dateRight));
    }

    public function test_birthdayPlanner_fileExists()
    {
        $filename = __DIR__ . '/../../src/BirthdayPlanner.php';
        $this->assertFileExists($filename);
    }

    public function test_birthdayPlanner_classExists()
    {
        $this->assertTrue(class_exists('App\BirthdayPlanner'));
    }

    public function test_birthdayPlanner_objectInstance()
    {
        $birthdayPlanner = new \App\BirthdayPlanner();
        $this->assertInstanceOf(\App\BirthdayPlanner::class, $birthdayPlanner);
    }

    public function test_birthdayPlanner_getNextBirthdayMessage()
    {
        $user = new \App\User();

        $user->setFirstname('John');
        $user->setLastname('Doe');
        $user->setBirthday(new \DateTime('1990-10-01'));

 
        $dateCalculator = new \App\DateCalculator();
        $dateLeft = new \DateTime('now');

        $birthday = $user->getBirthday();
        $birthday->setDate($dateLeft->format('Y'), $birthday->format('m'), $birthday->format('d'));

        $daysLeft = $dateCalculator->getDaysBetweenTwoDates($dateLeft, $birthday);

        $birthdayPlanner = new \App\BirthdayPlanner();

        $expectedMessage = "Hello John Doe ! There are $daysLeft days until your next birthday !";
        $this->assertEquals($expectedMessage, $birthdayPlanner->getNextBirthdayMessage($user));
    }
}
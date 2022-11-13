<?php

use App\Models\DinnerEvent;
use App\Util\WednesdaysForDinnerEvents;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use function Spatie\PestPluginTestTime\testTime;

uses(RefreshDatabase::class);
uses(TestCase::class);

test('get the next 4 Wednesdays which are available', function () {
    $nextWednesdays = WednesdaysForDinnerEvents::getWednesdaysForDinnerEvents(4);

    $this->assertCount(4, $nextWednesdays);
    $this->assertTrue($nextWednesdays[0]["available"]);
    $this->assertTrue($nextWednesdays[1]["available"]);
    $this->assertTrue($nextWednesdays[2]["available"]);
    $this->assertTrue($nextWednesdays[3]["available"]);

    $this->assertEquals(3, date('w', $nextWednesdays[0]["date"]->getTimestamp()));
    $this->assertEquals(3, date('w', $nextWednesdays[1]["date"]->getTimestamp()));
    $this->assertEquals(3, date('w', $nextWednesdays[2]["date"]->getTimestamp()));
    $this->assertEquals(3, date('w', $nextWednesdays[3]["date"]->getTimestamp()));
});

test('get the next wednesdays where the first is not available', function () {
    testTime()->freeze('2022-10-03 12:00:00');

    DinnerEvent::factory()->create([
        'date' => '2022-10-05',
        'registration_deadline' => '2022-10-04 20:00:00',
    ]);

    $nextWednesdays = WednesdaysForDinnerEvents::getWednesdaysForDinnerEvents(2);

    $this->assertFalse($nextWednesdays[0]["available"]);
    $this->assertTrue($nextWednesdays[1]["available"]);
});

test('get the the same wednesday on the wednesday itself', function () {
    testTime()->freeze('2022-10-05 12:00:00');

    $nextWednesdays = WednesdaysForDinnerEvents::getWednesdaysForDinnerEvents(1);
    $this->assertEquals(Carbon::create(2022, 10, 05, 0, 0, 0)->toISOString(), $nextWednesdays[0]["date"]->toISOString());
});

test('get the the same wednesday on the wednesday on 23:59', function () {
    testTime()->freeze('2022-10-05 23:59:00');

    $nextWednesdays = WednesdaysForDinnerEvents::getWednesdaysForDinnerEvents(1);
    $this->assertEquals(Carbon::create(2022, 10, 05, 0, 0, 0)->toISOString(), $nextWednesdays[0]["date"]->toISOString());
});

test('get the next wednesday on the day after wednesday', function () {
    testTime()->freeze('2022-10-06 00:00:00');

    $nextWednesdays = WednesdaysForDinnerEvents::getWednesdaysForDinnerEvents(1);
    $this->assertEquals(Carbon::create(2022, 10, 12, 0, 0, 0)->toISOString(), $nextWednesdays[0]["date"]->toISOString());
});

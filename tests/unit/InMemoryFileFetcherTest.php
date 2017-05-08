<?php

namespace FileFetcher\Tests\Phpunit;

use FileFetcher\InMemoryFileFetcher;
use PHPUnit\Framework\TestCase;

/**
 * @covers FileFetcher\InMemoryFileFetcher
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class InMemoryFileFetcherTest extends TestCase {

	public function testWhenEmptyHash_requestsCauseException() {
		$fetcher = new InMemoryFileFetcher( array() );

		$this->expectException( 'FileFetcher\FileFetchingException' );
		$fetcher->fetchFile( 'http://foo.bar/baz' );
	}

	public function testWhenUrlNotKnown_requestsCauseException() {
		$fetcher = new InMemoryFileFetcher( array(
			'http://something.else/entirely' => 'kittens'
		) );

		$this->expectException( 'FileFetcher\FileFetchingException' );
		$fetcher->fetchFile( 'http://foo.bar/baz' );
	}

	public function testWhenUrlKnown_requestsReturnsValue() {
		$fetcher = new InMemoryFileFetcher( array(
			'http://something.else/entirely' => 'kittens',
			'http://foo.bar/baz' => 'cats'
		) );

		$this->assertSame( 'cats', $fetcher->fetchFile( 'http://foo.bar/baz' ) );
	}

}

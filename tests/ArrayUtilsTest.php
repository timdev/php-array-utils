<?php
namespace TimDev;

use \TimDev\ArrayUtils as A;

class ArrayUtilsTest extends \PHPUnit_Framework_TestCase
{

    private $testHash = array(
        'name' => 'The Mothers of Invention',
        'members' => [
            ['name' => 'Frank Zappa', 'roles' => ['Guitar', 'Conductor', 'Vocals']],
            ['name' => 'Jimmy Carl Black', 'roles' => ['Percussion', 'Drums', 'Vocals', 'The Indian of the Group']],
            ['name' => 'Ray Collins', 'roles' => ['Vocals', 'Harmonica', 'Cymbals', 'Sound Effects']],
            ['name' => 'Roy Estrada', 'roles' => ['Bass', 'Guitarron']],
            ['name' => 'Elliot Ingber', 'roles' => ['Guitar']],
        ],
        'albums' => [
            'Freak Out!' => [
                'year' => '1963',
                'tracks' => [
                    "Hungry Freaks, Daddy",
                    "I Ain't Got No Heart",
                    "Who Are the Brain Police?",
                    "Go Cry on Somebody Else's Shoulder",
                    "Motherly Love",
                    "How Could I Be Such a Fool",
                    "Wowie Zowie",
                    "You Didn't Try to Call Me",
                    "Any Way the Wind Blows",
                    "I'm Not Satisfied",
                    "You're Probably Wondering Why I'm Here",
                    "Trouble Every Day",
                    "Help, I'm a Rock",
                    "The Return of the Son of Monster Magnet"
                ]
            ]
        ]
    );


    public function testValExtantStringKey()
    {
        $this->assertEquals($this->testHash['members'], A::val($this->testHash, 'members'));
        $this->assertEquals($this->testHash['name'], A::val($this->testHash, 'name'));
    }

    public function testValExtantDeepString()
    {
        $this->assertEquals(
            $this->testHash['albums']['Freak Out!']['year'],
            A::val($this->testHash, ['albums', 'Freak Out!', 'year'])
        );
    }

    public function testValReturnsDefaultForNonExistantKey()
    {
        $this->assertEquals('foobaz', A::val($this->testHash, 'name2', 'foobaz'));
        $this->assertEquals('foobaz', A::val($this->testHash, ['albums', 'Absolutely Free'], 'foobaz'));
    }

    public function testValDefaultDefaultValueIsNull(){
        $this->assertNull(A::val($this->testHash, 'invalid key'));
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessageRegExp  #Invalid array key at index.*#
     */
    public function testValThrowsOnInvalidKeyType()
    {
        A::val($this->testHash, false, 'default-val');
    }

    public function testValIntKeys()
    {
        $this->assertEquals('Percussion', A::val($this->testHash, ['members', 1, 'roles', 0]));
    }
}
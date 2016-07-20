<?php

namespace CodePress\CodeTag\Tests\Models;

use CodePress\CodeTag\Models\Tag;
use CodePress\CodeTag\tests\AbstractTestCase;
use Illuminate\Validation\Validator;
use Illuminate\Support\MessageBag;
use Mockery as m;

class TagTest extends AbstractTestCase {

    public function setUp() {
        parent::setUp();
        $this->migrate();
    }
        
   public function test_inject_validator_in_tag_model() {
        $tag = new Tag();
        $validator = m::mock(Validator::class);
        $tag->setValidator($validator);
        $this->assertEquals($tag->getValidator(), $validator);
    }

    public function test_check_if_a_tag_can_be_persisted() {
        $tag = Tag::create([
                    'name' => 'Tag Test',
                    'active' => true
        ]);
        $this->assertEquals('Tag Test', $tag->name);
    }

    public function test_if_can_assign_a_parent_to_a_tag() {
        $parentTag = Tag::create(['name' => 'Parent Test', 'active' => true]);
        $tag = Tag::create(['name' => 'Tag Test', 'active' => true]);
        $tag->parent()->associate($parentTag)->save();

        $child = $parentTag->children->first();

        $this->assertEquals('Tag Test', $child->name);
        $this->assertEquals('Parent Test', $child->parent->name);
    }

}

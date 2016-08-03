<?php

namespace CodePress\CodeTag\Tests\Models;

use \CodePress\CodePosts\Models\Post;
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

    public function test_can_add_posts_to_tags()
    {

        $tag = Tag::create([
            'name' => 'Tag Teste',
            'acive' => true
        ]);

        $post1 = Post::create(['title'=>'teste post 1', 'content'=>'conteudo post1']);
        $post2 = Post::create(['title'=>'teste post 2', 'content'=>'conteudo post2']);

        $post1->tags()->save($tag);
        $post2->tags()->save($tag);

        $this->assertCount(1, Tag::all());
        $this->assertEquals('Tag Teste', $post1->tags->first()->name);
        $this->assertEquals('Tag Teste', $post2->tags->first()->name);

        $posts = Tag::find(1)->posts;

        $this->assertCount(2, $posts);

        $this->assertEquals('teste post 1', $posts[0]->title);
        $this->assertEquals('teste post 2', $posts[1]->title);

    }

}

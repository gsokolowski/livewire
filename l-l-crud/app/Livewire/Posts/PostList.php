<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\Component;

class PostList extends Component
{
    #[Layout('layouts.app')]

    public int $page = 1;

    public int $perPage = 15;

    public bool $loading = false;

    public function loadMore(): void
    {
        if ($this->loading) {
            return;
        }

        $total = Post::count();
        if ($this->page * $this->perPage >= $total) {
            return;
        }

        $this->loading = true;
        $this->page++;
    }

    public function render()
    {
        $this->loading = false;

        $total = Post::count();
        $posts = Post::with('user')
            ->latest()
            ->take($this->perPage * $this->page)
            ->get();

        $hasMore = $total > $posts->count();

        return view('livewire.posts.post-list', [
            'posts' => $posts,
            'hasMore' => $hasMore,
        ]);
    }
}

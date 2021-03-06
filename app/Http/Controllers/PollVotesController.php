<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\Choice;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class PollVotesController extends Controller
{
    public function __invoke(Poll $poll)
    {
        request()->validate([
            'choice' => ['required', Rule::in($poll->choices()->pluck('id')->toArray())]
        ]);

        // ## Use it for race conditions tests
        // $choice = $poll->choices()->findOrFail(request('choice'));
        // logger()->debug('** BEFORE ' . request('user_id') . '**' . $choice->votes);
        // $poll->choices()->findOrFail(request('choice'))->increment('votes');
        // logger()->debug('** AFTER ' . request('user_id') . '**' . $choice->fresh()->votes);

        DB::table('choices')
            ->where('id', request('choice'))
            ->sharedLock()
            ->increment('votes');

        // $poll
        //     ->choices()
        //     ->findOrFail(request('choice'))
        //     ->sharedLock()
        //     ->increment('votes');

        return redirect()->route('polls.results', $poll)
            ->with('notification.success', 'Merci d\'avoir répondu à ce sondage!');
    }
}

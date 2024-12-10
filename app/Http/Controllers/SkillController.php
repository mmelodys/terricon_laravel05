<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Skill;

class SkillController extends Controller
{
    public function renderCreatePage ()
    {
        $skills = Skill::all();

        return view('createSkill')->with('skills', $skills);
    }
    
    public function createSkill (Request $request) 
    {
        $data = $request->all();

        /**
         * REQUEST
         * data/query (?get_data=1, {data: 1})
         * headers: { Authorization: 'TOKEN' }
         * 
         * RESPONSE
         * status_code (200, 300, 400, 500)
         * data
         */

        $skill = Skill::create($data);

        return back();
    }

    public function getApiSkills () 
    {
        $skills = Skill::all();

        return response()->json([
            'data' => $skills,
            'count_data' => $skills->count()
        ]);
    }

    public function createApiSkill ()
    {
        $data = request()->all();
        $skill = null;

        if(isset($data['name'])) {
            $skill = Skill::create($data);
        }

        return response()->json([
            'data' => $skill
        ]);
    }

    public function deleteSkill ($id)
    {
        $skill = Skill::find($id);

        if($skill) {
            $skill->delete();
        }

        return back();
    }
}
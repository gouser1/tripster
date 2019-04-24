<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Party;
use DB;
use Auth;
use sentry;

class PartyController extends Controller
{
     


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Gets the current party the user is in

        // Get the current user info
        $user = Auth::user();
        $id = $user->id;
        $type = $user->type;
        $party_id = $user->party_id;

        // Get the party information (select all)
        $party = DB::table('party')->where('party_id', $party_id)->get();

        // Get the users in the users party
        $users_in_party = DB::table('users')->where('party_id', $party_id)->get();

        // Return both the party information and the users in the party
        return json_encode(array_merge(json_decode($party, true),json_decode($users_in_party, true)));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Get the party name from the request
        $party_name = $request->input('party_name');
        
        // Update the new party with the party name
        $data = array("party_name"=>$party_name);
        DB::table('party')->insert($data);

        // Get the new party id
        $party_id = Party::max('party_id');

        // Update users table with party_id

        // Current user
        $user = Auth::user();
        $id = $user->id;

        DB::table('users')
            ->where('id', $id)
            ->update(['party_id' => $party_id]);

        // Friends emails
        $friends_emails = $request->input('friends_emails');
        $emails = explode(",", $friends_emails);

        for ($i = 0; $i < count($emails); $i++) {
            DB::table('users')
            ->where('email', $emails[$i])
            ->update(['party_id' => $party_id]);
        }

        return response(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

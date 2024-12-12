<?php
namespace App\Http\Controllers;

use App\Casa\TransactionAuthor;
use App\Http\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Transaction;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;


class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$transactions = Transaction::where('id', '>', -1)
        ->orderBy('created_at', 'desc');

        if ($request->input('page') == null ||
            $request->input('page') == '') {
            $transactions = $transactions->get();
        } else {
            $transactions = $transactions->paginate();
        }

        $data = [
            'success' => true,
            'transactions' => $transactions
        ];

        return response()->json($data);
    }

    public function user_index(Request $request) {
        $auth_user = Auth::getUser($request, Auth::USER);
        $data = [
            'success' => true,
            'transactions' => $auth_user->account()
            ->transactions()->orderBy('©reated_at', 'desc')->paginate()
        ];

        return response()->json($data, 200);
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
    public function store(StoreTransactionRequest $request)
    {
        $validated = $request->validated();

        $transaction = new Transaction;

        $transaction->amount = $validated['amount'] ?? null;
		$transaction->type = $validated['type'] ?? null;
		$transaction->author = $validated['author'] ?? null;
		$transaction->description = $validated['description'] ?? null;
		$transaction->account_id = $validated['account_id'] ?? null;

        $transaction->save();

        $data = [
            'success'       => true,
            'transaction'   => $transaction
        ];

        return response()->json($data);
    }

    public function user_store(StoreTransactionRequest $request) {
        $auth_user = Auth::getUser($request, Auth::USER);
        $validated = $request->validated();

        $transaction = new Transaction;

        $transaction->amount = $validated['amount'] ?? null;
		$transaction->type = $validated['type'] ?? null;
		$transaction->author = TransactionAuthor::SELF;
		$transaction->description = $validated['description'] ?? null;
		$transaction->account_id = $auth_user->account->id;

        $transaction->save();

        $data = [
            'success'       => true,
            'transaction'   => $transaction
        ];

        return response()->json($data, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        $data = [
            'success' => true,
            'transaction' => $transaction
        ];

        return response()->json($data);
    }
    
    public function user_show(Request $request, Transaction $transaction)
    {
        $auth_user = Auth::getUser($request, Auth::USER);
        $transaction = Transaction::where('account_id', $auth_user->account->id)->findOrFail();

        $data = [
            'success' => true,
            'transaction' => $transaction
        ];

        return response()->json($data);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        $validated = $request->validated();

        $transaction->amount = $validated['amount'] ?? null;
		$transaction->type = $validated['type'] ?? null;
		$transaction->author = $validated['author'] ?? null;
		$transaction->description = $validated['description'] ?? null;
		$transaction->account_id = $validated['account_id'] ?? null;

        $transaction->save();

        $data = [
            'success'       => true,
            'transaction'   => $transaction
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        $data = [
            'success' => true,
            'transaction' => $transaction
        ];

        return response()->json($data);
    }
}

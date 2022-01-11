<?php

namespace App\Http\Livewire\Expense;

use App\Models\Expenses;
use Livewire\Component;

class ExpenseList extends Component
{
 
    public function render()
    {
        $expenses = Expenses::all(['id','description','amount','type','created_at']);
        return view('livewire.expense.expense-list',compact('expenses'));
    }
}

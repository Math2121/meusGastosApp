<?php

namespace App\Http\Livewire\Expense;

use App\Models\Expenses;
use Livewire\Component;

class ExpenseEdit extends Component
{
    public Expenses $expense;
    public $amount;
    public $type;
    public $description;

    protected $rules = [
        'amount' => "required",
        'type' => 'required',
        'description' => 'required'
    ];
    // ele e executado assim que o componente e renderizado
    public function mount()
    {
        $this->amount = $this->expense->amount;
        $this->description = $this->expense->description;
        $this->type = $this->expense->type;
    }
    public function updateExpense()
    {
        $this->validate();
        $this->expense->update([
            'description' => $this->description,
            'type' => $this->type,
            'amount' => $this->amount,

        ]);
        session()->flash('message', 'Tudo certo');
    }
    public function render()
    {
        return view('livewire.expense.expense-edit');
    }
}

<?php

namespace App\Http\Livewire\Expense;

use App\Models\Expenses;
use Livewire\Component;

class ExpenseCreate extends Component
{
    // atributos públicos renderizam na view
    public $amount;
    public $type;
    public $description;

    // regras de validação de dados
    protected $rules = [
        'amount' => "required",
        'type' => 'required',
        'description' => 'required'
    ];
    public function render()
    {
        return view('livewire.expense.expense-create');
    }
    public function createExpense()

    {
        $this->validate();


        auth()->user()->expenses()->create([
            'description' => $this->description,
            'type' => $this->type,
            'amount' => $this->amount,
            'user_id' => 1
        ]);

        session()->flash('message','Tudo certo');

        $this->amount = $this->description = $this->description = null;
    }
}

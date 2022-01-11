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


        Expenses::create([
            'amount' => $this->amount,
            'type' => $this->type,
            'description' => $this->description,
            'user_id' => 1
        ]);

        session()->flash('message','Tudo certo');

        $this->amount = $this->description = $this->description = null;
    }
}

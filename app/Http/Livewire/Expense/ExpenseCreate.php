<?php

namespace App\Http\Livewire\Expense;

use App\Models\Expenses;
use Livewire\Component;
use Livewire\WithFileUploads;

class ExpenseCreate extends Component
{
    use WithFileUploads;
    // atributos públicos renderizam na view
    public $amount;
    public $type;
    public $description;
    public $photo;
    public $expenseDate;
    // regras de validação de dados
    protected $rules = [
        'amount' => "required",
        'type' => 'required',
        'description' => 'required',
        'photo' => 'image|nullable'
    ];
    public function render()
    {
        return view('livewire.expense.expense-create');
    }
    public function createExpense()

    {
        $this->validate();

        if ($this->photo) {
            $photo = $this->photo->store('expenses-photos');
        }
        auth()->user()->expenses()->create([
            'description' => $this->description,
            'type' => $this->type,
            'amount' => $this->amount,
            'user_id' => 1,
            'photo' => $photo ?? null,
            'expense_date'=>$this->expenseDate
        ]);

        session()->flash('message', 'Tudo certo');

        $this->amount = $this->description = $this->description = null;
    }
}

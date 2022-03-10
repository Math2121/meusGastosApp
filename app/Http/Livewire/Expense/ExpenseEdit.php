<?php

namespace App\Http\Livewire\Expense;

use App\Models\Expenses;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ExpenseEdit extends Component
{
    use WithFileUploads;

    public Expenses $expense;
    public $amount;
    public $type;
    public $description;
    public $photo;
    protected $rules = [
        'amount' => "required",
        'type' => 'required',
        'description' => 'required',
        'photo' => 'image|nullable'
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
        if ($this->photo) {
            if (Storage::disk('public')->exists($this->expense->photo))
                Storage::disk('public')->delete($this->expense->photo);
            $this->photo = $this->photo->store('expenses-photos', 'public');
        }

        $this->expense->update([
            'description' => $this->description,
            'type' => $this->type,
            'amount' => $this->amount,
            'photo' => $this->photo ?? $this->expense->photo

        ]);
        session()->flash('message', 'Tudo certo');
    }
    public function render()
    {
        return view('livewire.expense.expense-edit');
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IntentionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('contents') && is_string($this->contents)) {
            $this->merge([
                'contents' => json_decode($this->contents, true),
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'mass_date' => 'required|date|after_or_equal:' . now()->toDateString(),
            'mass_hour' => 'required|date_format:H:i',
            'contents' => 'required|array',
            'contents.*' => 'string',
            'church_id' => 'required|exists:churches,id'
        ];
    }

    public function messages(): array
    {
        return [
            'mass_date.required' => 'A data e horário da missa devem ser informados.',
            'mass_date.after_or_equal' => 'A data da missa deve ser igual ou posterior a hoje.',
            'mass_hour.required' => 'O horário da missa deve ser informado.',
            'mass_hour.date_format' => 'O formato do horário deve ser HH:mm.',
            'contents.required' => 'Suas intenções devem ser informadas.',
            'church_id.required' => 'A igreja deve ser informada.',
            'church_id.exists' => 'A igreja selecionada não existe.'
        ];
    }
} 
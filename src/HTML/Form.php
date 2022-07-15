<?php
namespace App\HTML;

class Form {

    private $data;
    private $errors;

    public function __construct($data, array $errors)
    {
        $this->data = $data;
        $this->errors = $errors;
    }

    public function input(string $key, string $label): string
    {
        $value = $this->getValue($key);
        $inputClass = '';

        return <<<HTML
            <div class="field">
                <label for="field{$key}" class="field-label">{$label}</label>
                <input class="field-input {$this->getInputClass($key)}" id="field{$key}" name="{$key}" value="{$value}" required>
                {$this->getErrorFeedBack($key)}
            </div>
HTML;
    }

    public function textarea(string $key, string $label): string
    {
        $value = $this->getValue($key);
        return <<<HTML
            <div class="field-message">
                <label for="field{$key}" class="field-label-message">{$label}</label>
                <textarea class="field-textarea {$this->getInputClass($key)}" id="field{$key}" name="{$key}" value="{$value}" required>{$value}</textarea>
                {$this->getErrorFeedBack($key)}
            </div>
HTML;
    }

    private function getValue(string $key): ?string
    {
        if(is_array($this->data)){
            return $this->data[$key] ?? null;
        }
        $method = 'get' . str_replace(' ', '' , ucwords(str_replace('_', ' ', $key)));
        $value = $this->data->$method();
        if($value instanceof \DateTimeInterface){
            return $value->format('d.m.Y');
        }
        return $value;
    }

    private function getInputClass(string $key): string
    {
        $inputClass = '';
        if(isset($this->errors[$key])){
            $inputClass .= 'is-invalid';
        }
        return $inputClass;
    }

    private function getErrorFeedBack(string $key): string
    {
        if(isset($this->errors[$key])){
            return $invalidFeedBack = '<div class="invalid-feedback">' . implode('<br>', $this->errors[$key]) . '</div>';
        }
        return '';
    }
}
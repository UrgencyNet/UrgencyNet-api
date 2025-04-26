<?php  

namespace App\Http\Requests;  

use Illuminate\Foundation\Http\FormRequest;  

/**  
 * Class LoginUserRequest  
 *  
 * Handles validation and authorization logic for user login requests.  
 *  
 * @package App\Http\Requests  
 */  
class LoginUserRequest extends FormRequest  
{  
    /**  
     * Determine if the user is authorized to make this request.  
     *  
     * @return bool  
     */  
    public function authorize(): bool  
    {  
        // Allow all users to attempt login  
        return true;  
    }  

    /**  
     * Get the validation rules that apply to the request.  
     *  
     * @return array<string, string>  
     */  
    public function rules(): array  
    {  
        return [  
            'email' => 'required|string|email',  
            'password' => 'required|string',  
        ];  
    }  

    /**  
     * Get custom error messages for validation failures.  
     *  
     * @return array<string, string>  
     */  
    public function messages(): array  
    {  
        return [  
            'email.required' => 'Email is required',  
            'email.email' => 'Valid email address is required',  
            'password.required' => 'Password is required',  
        ];  
    }  
}  
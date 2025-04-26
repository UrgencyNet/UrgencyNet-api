<?php  

namespace App\Http\Controllers;  

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;  
use Illuminate\Foundation\Bus\DispatchesJobs;  
use Illuminate\Foundation\Validation\ValidatesRequests;  
use Illuminate\Routing\Controller as BaseController;  

/**  
 * Class Controller  
 *  
 * The base controller class from which all application controllers extend.  
 * Provides common traits for authorization, job dispatching, and request validation.  
 *  
 * @package App\Http\Controllers  
 */  
class Controller extends BaseController  
{  
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;  
}
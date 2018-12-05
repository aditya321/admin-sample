<?php

namespace App\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


/**
 * This class is base class for all API request
 * @author Shyam
 */
class BaseApiRequest extends Request {

    protected $response = null;

    /**
     * Get data to be validated from the request.
     * This method is used to get json input for APIs and validate the data
     * @return array
     */
    protected function validationData() {
        $postData = Request::all();
        return $postData;
    }
    
    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator) {
        $errors = $validator->errors();
        if (!$this->wantsJson() && (!str_contains(\Request::getRequestUri(), 'api'))) {
            return parent::failedValidation($validator);
        }
        $this->response['status'] = 0;
        $this->response['result'] = [];
        $this->response['message'] = $errors->first();
        $this->response['statusCode'] = Response::HTTP_OK;
        throw new HttpResponseException(response()->json($this->response, Response::HTTP_OK));
    }

}

<?php

return [
    'API_KEY' => '4765465654DFGDF64546FDG4FD654G6DF',
    'PIN_CODE_CHECK' => '4bd146630a981351ec94e119e031515c66ed1954',
//OK. The standard success code and default option.
    'ok' => 200,
//    Object created. Useful for the store actions.
    'ok-1' => 201,
//No content. When an action was executed successfully, but there is no content to return.
    'blank' => 204,
//206: Partial content. Useful when you have to return a paginated list of resources.
    'partial' => 206,
//400: Bad request. The standard option for requests that fail to pass validation.
    'bad_request' => 400,
//401: Unauthorized. The user needs to be authenticated.
    'unauthorized' => 401,
//403: Forbidden. The user is authenticated, but does not have the permissions to perform an action.
    'forbidden' => 403,
//404: Not found. This will be returned automatically by Laravel when the resource is not found.
    'not_found' => 404,
//500: Internal server error. Ideally you're not going to be explicitly returning this, but if something unexpected breaks, this is what your user is going to receive.
    'server_error' => 500,
//503: Service unavailable. Pretty self explanatory, but also another code that is not going to be returned explicitly by the application.
    'service_unavailable' => 503,
    'DATA_NOT_FOUND' => 'Record not found.',
    'DATA_FOUND' => 'Record retrieved successfully.',
    'NOT_VALID' => 'Validation failed.',
    'USER_ADDED' => 'User has been added successfully.',
    'USER_UPDATED' => 'User has been updated successfully.',
    'USER_DELETED' => 'User has been deleted successfully.',
    'LOGIN' => 'LoggedIn successfully.',
    'MOBILE_NOT_VERIFIED' => 'Mobile number is not verified.',
    'ACCOUNT_DEACTIVATED' => 'Account deactivated. Please contact to admin.',
    'OTP_SENT' => 'OTP has been sent.',
    'OTP_VERIFIED' => 'Otp verified.',
    'INCORRECT_OTP' => 'Incorrect Otp.',
    'INCORRECT_PASSWORD' => 'Incorrect credentials.',
    'USER_FOUND' => 'User found need OTP to login.',
    'USER_NOT_FOUND' => 'User not found.',
    'MOBILE_NOT_REGISTERED' => 'Mobile not registered. Please create account.',
    'INCORRECT_MOBILE' => 'Incorrect mobile.',
    'ACCESS_NOT_ALLOWED' => 'You are not a authorised user.',
    'REGISTERED_SUCCESS' => 'Registration has been completed successfully.',
    'RECORD_UPDATED' => 'Record has been updated successfully.',
    'RECORD_NOT_UPDATED' => 'Something went wrong.Please try again.',
    'EMAIL_SENT_WITH_PASSWORD' => 'New password has been sent to your registered email address.',
    'MOBILE_NUMBER_VERIFIED' => 'Mobile number verified successfully.',
    'MOBILE_ALREADY_VERIFIED' => 'Mobile number verified already.',
    'OTP_EXPIRED' => 'OTP has been expired.',
    'INVALID_EMAIL_AND_PASSWORD' => 'Invalid email and password.'
];
?>
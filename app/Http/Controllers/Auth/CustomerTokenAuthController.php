<?php

namespace App\Http\Controllers\Auth;

use App\Customers\Customer;
use App\Customers\Exceptions\CustomerNotFoundException;
use Illuminate\Database\ModelNotFoundException;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Laravel\Passport\TokenRepository;
use League\OAuth2\Server\AuthorizationServer;
use Psr\Http\Message\ServerRequestInterface;
use Lcobucci\JWT\Parser as JwtParser;

class CustomerTokenAuthController extends AccessTokenController
{
     /**
      * The authorization server.
      *
      * @var \League\OAuth2\Server\AuthorizationServer
      */
     protected $server;
    
     /**
      * The token repository instance.
      *
      * @var \Laravel\Passport\TokenRepository
      */
     protected $tokens;
    
     /**
      * The JWT parser instance.
      *
      * @var \Lcobucci\JWT\Parser
      */
     protected $jwt;
    
     /**
      * Create a new controller instance.
      *
      * @param  \League\OAuth2\Server\AuthorizationServer  $server
      * @param  \Laravel\Passport\TokenRepository  $tokens
      * @param  \Lcobucci\JWT\Parser  $jwt
      */
     public function __construct(AuthorizationServer $server,
                                 TokenRepository $tokens,
                                 JwtParser $jwt)
     {
         parent::__construct($server, $tokens, $jwt);
     }

     /**
      * Override the default Laravel Passport token generation
      *
      * @param ServerRequestInterface $request
      * @return array
      * @throws UserNotFoundException
      */
     public function issueToken(ServerRequestInterface $request)
     {
         $body = (parent::issueToken($request));
         $token = json_decode($body, true);
        
         if (array_key_exists('error', $token)) {
             return response()->json([
                 'error' => $token['error'],
                 'status_code' => 401
             ], 401);
         }
         
        $data = $request->getParsedBody();
        
        $email = $data['username'];  
           
        switch ($data['provider']) {
            case 'customers';
                
                try {
                
                 $user = Driver::where('email', $email)->firstOrFail();
                 
                } catch (ModelNotFoundException $e) {
                  return response()->json([
                      'error' => $e->getMessage(),
                      'status_code' => 401
                  ], 401);
                }
            
                break;
            
            default :
            
                try {
                
                 $user = User::where('email', $email)->firstOrFail();
                 
                } catch (ModelNotFoundException $e) {
                  return response()->json([
                      'error' => $e->getMessage(),
                      'status_code' => 401
                  ], 401);
                }        
        }
         
        return compact('token', 'user');
    }
}
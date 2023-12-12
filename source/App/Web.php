<?php

namespace Source\App;

// use FFI\Exception;
use League\Plates\Engine;
use PHPMailer\PHPMailer\SMTP;
use Source\Models\Product;
use Source\Models\Sale;
use Source\Models\SaleProduct;
use Source\Models\Usuario;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use \Firebase\JWT\JWT;
use Firebase\JWT\Key;
use stdClass;


class Web
{
    private $view;

    public function __construct()
    {
        $this->view = new Engine(CONF_VIEW_WEB, 'php');
    }

    public function home(): void
    {
        echo $this->view->render("home");
    }

    public function about(): void
    {
        echo $this->view->render("about");
    }

    public function products()
    {
        $product = new Product();
        $products = $product->selectAllProducts();

        echo $this->view->render("products", ["seresVivos" => $products]);
    }

    public function loginAndRegister(): void
    {
        echo $this->view->render("login-register");
    }

    public function contact(): void
    {
        echo $this->view->render("contact");
    }

    public function registerAddress()
    {
        echo $this->view->render("register-address");
    }

    public function registerAddressPost(array $data)
    {
        if (!empty($data)) {

            $userSession = $_SESSION['user'];
            $address = new \Source\Models\Address(
                $data['register-street'],
                $data['register-number'],
                $data['register-complement'],
                $data['register-city'],
                $data['register-state'],
                $data['register-zipCode'],
                $userSession["id"]
            );

            $returnInsert = $address->insertAddress();

            if ($returnInsert == true) {
                $addressJson = [
                    "code" => 200,
                    "type" => "success",
                    "message" => "Endereço cadastrado com sucesso!"
                ];
                echo json_encode($addressJson);
            } else {
                $addressJson = [
                    "code" => 400,
                    "type" => "bad_request",
                    "message" => "Não foi possível realizar esta ação :("
                ];
                echo json_encode($addressJson);
            }
        }
    }

    public function registerUser()
    {
        echo $this->view->render("register-user");
    }

    public function registerUserPost(array $data)
    {
        if (!empty($data)) {
            $user = new Usuario(
                $data['register-email'],
                $data['register-name'],
                $data['register-phoneNumber'],
                $data['register-password'],
                $data['register-dtBorn'],
                $data['register-document']
            );

            $returnInsert = $user->cadastrarUsuario();

            if ($returnInsert == true) {
                $userJson = [
                    "code" => 200,
                    "type" => "success",
                    "message" => "Usuário cadastrado com sucesso!"
                ];
                echo json_encode($userJson);
            } else {
                $userJson = [
                    "code" => 400,
                    "type" => "bad_request",
                    "message" => "Não foi possível realizar esta ação :("
                ];
                echo json_encode($userJson);
            }
        }
    }

    public function login()
    {
        echo $this->view->render("login");
    }

    public function loginPost(array $data)
    {
        // var_dump($data);

        // $token = $data['g_csrf_token']; // Substitua pelo seu token JWT

        // $key = $data['credential']; // Substitua pela chave secreta usada para assinar o token

        // $teste = array("HS256");

        // try {
        //     $decoded = JWT::decode($token, new Key($key, 'HS256'), $headers = new stdClass());
        //     print_r($decoded); // Exibe o conteúdo decodificado do token JWT
        // } catch (Exception $e) {
        //     echo 'Exceção: ' . $e->getMessage();
        // }

        $email = $data["login-email"];
        $password = $data["login-password"];
        // $sub = $data["sub"];

        if (empty($email) && empty($password)) {
            // if (!empty($sub)) {
            //     if (!empty($data["login-remember"])) {
            //         $remember = true;
            //     } else {
            //         $remember = false;
            //     }

            //     $user = new User();

            //     $returnValidate = $user->validateUserSub($sub, $remember);

            //     if ($returnValidate == true) {

            //         $id = $_SESSION["user"]["id"];
            //         $user = new User();
            //         $validate = $user->validateAdmUser($id);

            //         if ($validate == false) {
            //             $userJson = [
            //                 "type" => "send-success",
            //                 "adm" => "false"
            //             ];
            //         } elseif ($validate == true) {
            //             $userJson = [
            //                 "type" => "send-success",
            //                 "adm" => "true"
            //             ];
            //         }
            //         echo json_encode($userJson);
            //     } else {
            //         $userJson = [
            //             "type" => "send-error"
            //         ];
            //         echo json_encode($userJson);
            //     }
            // } 
            //  else {
                $userJson = [
                    "code" => 400,
                    "type" => "bad_request",
                    "message" => "Não foi possível realizar esta ação",
                    "subMessage" => "Informe o e-mail e senha",
                    "typeOfError" => "e-mail and password"
                ];
                echo json_encode($userJson);
                exit();
            // }
        } else {
            if (empty($email)) {
                $userJson = [
                    "code" => 400,
                    "type" => "bad_request",
                    "message" => "Não foi possível realizar esta ação",
                    "subMessage" => "Informe o e-mail",
                    "typeOfError" => "e-mail"
                ];
                echo json_encode($userJson);
                exit();
            }

            if (empty($password)) {
                $userJson = [
                    "code" => 400,
                    "type" => "bad_request",
                    "message" => "Não foi possível realizar esta ação",
                    "subMessage" => "Informe a senha",
                    "typeOfError" => "password"
                ];
                echo json_encode($userJson);
                exit();
            }
        }

        if (!empty($data["login-remember"])) {
            $remember = true;
        } else {
            $remember = false;
        }

        $user = new Usuario();

        $returnValidate = $user->validarUsuario($email, $password, $remember);

        if ($returnValidate === 'SUCCESS') {

            $id = $_SESSION["user"]["id"];
            $user = new Usuario();
            $validate = $user->validarUsuarioAdministrador($id);

            if ($validate == false) {
                $userJson = [
                    "code" => 200,
                    "type" => "success",
                    "message" => "Login efetuado com sucesso",
                    "subMessage" => "Redirecionando para a área logada",
                    "adm" => "false"
                ];
                echo json_encode($userJson);
                exit();
            } elseif ($validate == true) {
                $userJson = [
                    "code" => 200,
                    "type" => "success",
                    "message" => "Login efetuado com sucesso",
                    "subMessage" => "Redirecionando para a área logada",
                    "adm" => "true"
                ];
                echo json_encode($userJson);
                exit();
            }
        } else {
                 if ($returnValidate === 'ERROR_PASSWORD') {
                    $userJson = [
                        "code" => 400,
                        "type" => "bad_request",
                        "message" => "Erro",
                        "subMessage" => "Senha incorreta"
                    ];
                    echo json_encode($userJson);
                 } else {
                    $userJson = [
                        "code" => 400,
                        "type" => "bad_request",
                        "message" => "Erro",
                        "subMessage" => "E-mail não cadastrado"
                    ];
                    echo json_encode($userJson);
                 }
        }
    }

    public function viewProduct(array $data)
    {
        if (!empty($data)) {
            $pdct = new Product();
            $product = $pdct->selectProduct($data["idProduct"]);
        }
        echo $this->view->render("view-product", ["product" => $product]);
    }
    public function cart(): void
    {
        $product = new Product();
        $products = $product->selectAllProducts();

        echo $this->view->render("cart", ["products" => $products]);
    }

    public function checkout()
    {
        if (isset($_SESSION['user'])) {

            $userSession = $_SESSION['user'];

            $sale = new Sale(
                NULL,
                $_SESSION['cart']['total'],
                $userSession["id"]
            );
            $returnSale = $sale->insertSale();

            foreach ($_SESSION['cartItem'] as $key => $value) {
                $saleProduct = new SaleProduct(
                    NULL,
                    $returnSale,
                    $value['id'],
                    $value['price'],
                    NULL
                );
                $saleProduct->insertSaleProduct();
            }
            echo '<script>alert("Obrigado por comprar conosco!");</script>';
        } else {
            header("location:" . url("entrar"));
        }
    }

    public function forgotPassword()
    {
        echo $this->view->render("forgot-password");
    }


    public function forgotPasswordPost(array $data)
    {
        $otpEmail = $data['otp-email'];
        setcookie('otpEmail', $otpEmail, time() + 60 * 60 * 24, "/");

        $otpCodes = array();

        for ($i = 0; $i < 4; $i++) {
            $otpCode = random_int(0, 9);
            $otpCodes[] = isset($otpCodes[$i - 1]) ? $otpCodes[$i - 1] . $otpCode : $otpCode;
        }

        $lastOtpCode = end($otpCodes);
        $hashLastOtpCode = hash('md5', $lastOtpCode);
        setcookie("otpCode", $hashLastOtpCode, time() + 60, "/");

        echo $this->view->render("forgot-password", ["otpCodes" => $lastOtpCode]);

        // Configurações do servidor de e-mail
        $mail = new PHPMailer(true);

        try {
            // Configuração do servidor SMTP (pode variar de acordo com o provedor de e-mail)
            $mail->isSMTP();
            $mail->Host = 'smtp.umbler.com'; // Servidor SMTP
            $mail->SMTPAuth = true; // Autenticação SMTP
            $mail->Username = 'adm@chapeco3ab.com'; // Seu endereço de e-mail
            $mail->Password = '7njGW#TcGDrj3hek'; // Sua senha de e-mail
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Criptografia TLS
            $mail->Port = 587; // Porta SMTP

            // Configurações do e-mail
            $mail->setFrom('adm@chapeco3ab.com', 'Recuperar senha');
            $mail->addAddress($otpEmail, 'Destinatário');

            // Conteúdo do e-mail
            $mail->isHTML(true); // Define o e-mail como HTML
            $mail->Subject = 'Abra esse e-mail para recuperar sua senha';
            $mail->Body = '<p>Seu código de verificação é: <strong>'.$lastOtpCode.'</strong></p>';

            // Anexo
            // $attachmentPath = 'caminho/para/o/anexo/arquivo.pdf';
            // $mail->addAttachment($attachmentPath, 'nome_arquivo.pdf'); // Caminho e nome do arquivo

            // Envia o e-mail
            $mail->send();
            $_SESSION['otpCounter'] = 0;
        } catch (Exception $e) {
            $returnJsonError = [
                "code" => 400,
                "type" => "bad_request",
                "message" => "Erro ao enviar o e-mail: {$mail->ErrorInfo}"
            ];
            echo json_encode($returnJsonError);
        }

    }

    public function verifyOtp(array $data) {
        
        $otp1 = $data['otp1'];
        $otp2 = $data['otp2'];
        $otp3 = $data['otp3'];
        $otp4 = $data['otp4'];

        $otp = $otp1 . $otp2 . $otp3 . $otp4;
        $hashOtp = hash('md5', $otp);

        if (isset($_COOKIE['otpCode'])) {
            if ($hashOtp == $_COOKIE['otpCode']) {
                $returnJsonSuccess = [
                    "code" => 200,
                    "type" => "success",
                    "message" => "Código correto!",
                    "subMessage" => "Redirecionando..."
                ];
                setcookie("otpVerified", true, time() + 60 * 60 * 24, "/");
                setcookie('otpCode', null, time() - 3600, "/");  
                echo json_encode($returnJsonSuccess);
            } else {
                if ($_SESSION['otpCounter'] < 5) {
                    $returnJsonError = [
                        "code" => 400,
                        "type" => "bad_request",
                        "message" => "Erro",
                        "subMessage" => "Código incorreto!"
                    ];
                    $_SESSION['otpCounter']++;
                    echo json_encode($returnJsonError);
                } else {
                    $returnJsonError = [
                        "code" => 400,
                        "type" => "bad_request",
                        "message" => "Erro",
                        "subMessage" => "Tentativa máxima atingida"
                    ];
                    echo json_encode($returnJsonError);
    
                    setcookie('otpEmail', null, time() - 3600, "/");
                    setcookie('otpVerified', null, time() - 3600, "/");
                    setcookie('otpCode', null, time() - 3600, "/");             
                }
    
            }
        } else {
            $returnJsonError = [
                "code"=> 400,
                "type"=> "bad_request",
                "message"=> "Erro",
                "subMessage"=> "Código expirado",
            ];
            echo json_encode($returnJsonError);
        }

    }

    public function updatePassword()
    {
        echo $this->view->render("update-password");
    }

    public function updatePasswordPost(array $data) {
        if (!empty($data) && !empty($_COOKIE['otpVerified'])) {
            $user = new Usuario(
                NULL, 
                NULL, 
                NULL, 
                $data['update-password'],
                NULL,
                NULL,
                NULL
            );
            $returnInsert = $user->updatePassword($_COOKIE['otpEmail']);

            if ($returnInsert == true) {
                $returnJsonSuccess = [
                    "code" => 200,
                    "type" => "success",
                    "message" => "Senha alterada com sucesso!"
                ];
                $user->validarUsuario($_COOKIE['otpEmail'],$data['update-password'],true);
                unset($_SESSION['otpVerified']);
                echo json_encode($returnJsonSuccess);
            } else {
                $returnJsonError = [
                    "code" => 400,
                    "type" => "bad_request",
                    "message" => "Não foi possível realizar esta ação :("
                ];
                unset($_SESSION['otpVerified']);
                echo json_encode($returnJsonError);
            }
        } else {
            $returnJsonError = [
                "code" => 400,
                "type" => "bad_request",
                "message" => "Cookie ou dados não encontrados"
            ];
            echo json_encode($returnJsonError);
        }
    }

    public function error(array $data): void
    {
        //      echo "<h1>Erro {$data["errcode"]}</h1>";
        //      include __DIR__ . "/../../themes/web/404.php";
        echo $this->view->render("404", [
            "title" => "Erro {$data["errcode"]} | " . CONF_SITE_NAME,
            "error" => $data["errcode"]
        ]);
    }

    public function logout(): void
    {
        unset($_SESSION['cart']);
        unset($_SESSION['cartItem']);
        header("location:" . url("carrinho"));
    }
}
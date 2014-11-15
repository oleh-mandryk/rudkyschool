<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Auth_lib
{

//Перевіряє на збіг введені дані з даними з бази і авторизує в разі збігу
public function do_login($login,$pass)
{
    $CI =& get_instance();//Отримуємо доступ до об'єкта CodeIgniter

    //Правильні дані з бази даних
    $right_login = $CI->config->item('admin_login');
    $right_pass = $CI->config->item('admin_pass');

    //Перевірка на збіг (якщо збігаються, записуємо сесію)
    if (($right_login === $login) && ($right_pass === $pass))
    {
        $ses = array();
        $ses['admin_logined'] = 'yes';//Администратор вошел
        $ses['admin_hash'] = $this->the_hash();//Доп. защита - хэш

        $CI->session->set_userdata($ses);//Записываем сессию
        
        // Перенаправляємо на головну сторінку адмінки
        redirect ('administration');
    }

    //Якщо дані не збіглися, перенаправляємо на функцію login
    else
    {
        redirect ('administration/login');
    }
}

//------------------------------------------------------------------------------------------------------------------

public function the_hash()
{
    $CI =& get_instance();//Отримуємо доступ до об'єкта CodeIgniter

    //Формування хеша: пароль + IP + додаткове слово
    $hash = md5($CI->config->item('admin_pass').$_SERVER['REMOTE_ADDR'].'annapurna');
    
    return $hash;
}

//------------------------------------------------------------------------------------------------------------------

//Очищає дані сесії
public function do_logout()
{
    $CI =& get_instance();//Отримуємо доступ до об'єкта CodeIgniter

    $ses = array();
    $ses['admin_logined'] = '';
    $ses['admin_hash'] = '';

    $CI->session->unset_userdata($ses);//Видаляємо сесію

    redirect ('administration/login');
}

//------------------------------------------------------------------------------------------------------------------

//Функція для перевірки того, чи був здійснений вхід - проставити у всіх контролерах і функціях, доступ до яких повинен бути закритий паролем
public function check_admin()
{
    $CI =& get_instance();//Отримуємо доступ до об'єкта CodeIgniter

    //Якщо у сесії admin_logined = yes та хеш у сесії збігається із заново сгенерованими хешем функцією the_hash
    if (($CI->session->userdata('admin_logined') === 'yes') &&
    ($CI->session->userdata('admin_hash') === $this->the_hash()))
    {
        return TRUE;//Просто повертаємо значення, якщо все збігається
    }
    else
    {
        redirect ('administration/login');
    }
}
}
?>
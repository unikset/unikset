<?php
/**
 * Восстановление пароля
 * 
 */
class RecoveryController extends Controller
{

    public $defaultAction = 'recovery';

    /**
     * Recovery password
     */
    public function actionRecovery()
    {
        /**
         * Получаем объект формы восстановления
         */
        $form = new UserRecoveryForm;
        /**
         * Если пользователь аутентифицирован перенаправляем его на главную страницу
         */
        if (Yii::app()->user->id)
        {
            $this->redirect(Yii::app()->homeUrl);
        }
        else
        {
            /**
             * Извлекаем email из строки запроса(если есть)
             */
            $email = ((isset($_GET['email'])) ? $_GET['email'] : '');
            
            /**
             * Извлекаем ключ активации из строки запроса если есть
             */
            $activkey = ((isset($_GET['activkey'])) ? $_GET['activkey'] : '');
            /**
             * Если email и ключ активации получен начинаем процедуру восстановления
             */
            if ($email && $activkey)
            {
                /**
                 * Получаем объект формы смены пароля
                 */
                $form2 = new UserChangePassword;
                /**
                 * Извлекаем пользователя из бд по адресу эл.почты
                 */
                $find = User::model()->findByAttributes(array('email' => $email));
                
                /**
                 * Если такой пользователь есть и ключ активации совпадает
                 * Рендерим форму смены пароля
                 */
                if (isset($find) && $find->activkey == $activkey)
                {
                    /**
                     * Если данные пришли методом Пост работаем с данными из формы
                     */
                    if (isset($_POST['UserChangePassword']))
                    {
                        /**
                         * Массовое присваивание атрибутов
                         */
                        $form2->attributes = $_POST['UserChangePassword'];
                        /**
                         * Валидация данных
                         */
                        if ($form2->validate())
                        {
                            /**
                             * Хешируем новый пароль
                             */
                            $find->password = User::model()->hashPassword($form2->password,$find->salt);
                            /**
                             * Хеируем новый ключ активации
                             */
                            $find->activkey = User::encrypting();
                            
                            
                            if($find->save())
                            {
                                /**
                                 * Если данные успешно обновлены, создаем флешсообщение
                                 * и редиректим на страницу логина
                                 */
                                Yii::app()->user->setFlash('recoveryMessage', Yii::t('user',"New password is saved."));
                                $this->redirect(array("/recovery"));
                            }
                            
                        }
                    }
                    $this->render('changepassword', array('form' => $form2));
                }
                else
                {
                    /**
                     * Если данные из письма восстановления не совпали
                     * Создаем флешсообщение и редиректим на страницу восстановления пароля
                     */
                    Yii::app()->user->setFlash('recoveryMessage', Yii::t('user',"Incorrect recovery link."));
                    $this->redirect(array("/recovery"));
                }
            }
            else
            {
                /**
                 * Если к медоду обратились не по ссылке из письма
                 * То открываем форму восстаановления пароля
                 */
                if (isset($_POST['UserRecoveryForm']))
                {
                    /**
                     * Если данные пришли из формы, заполняем атрибуты модели
                     * формы восстановления пароля
                     */
                    $form->attributes = $_POST['UserRecoveryForm'];
                    /**
                     * Проверка данных
                     */
                    if ($form->validate())
                    {
                        /**
                         * Если данные прошли проверку, получаем объект пользователя из бд
                         */
                        $user = User::model()->findbyPk($form->id);
                        /**
                         * Генерируем ссылку активации
                         */
                        $activation_url = 'http://' . $_SERVER['HTTP_HOST'] . $this->createUrl(implode(array("/recovery/recovery")), array("activkey" => $user->activkey, "email" => $user->email));
                        /**
                         * Тема сообщения
                         */
                        $subject = Yii::t("user","You have requested the password recovery site {site_name}", array(
                                    '{site_name}' => Yii::app()->name,
                                ));
                        /**
                         * Тело сообщения
                         */
                        $message = Yii::t('user',"You have requested the password recovery site {site_name}. To receive a new password, go to {activation_url}.", array(
                                    '{site_name}' => Yii::app()->name,
                                    '{activation_url}' => $activation_url,
                                ));
                        /**
                         * Для отправки письма используем статический метод
                         * модели User
                         */
                        User::sendMail($user->email, $subject, $message);
                        /**
                         * Генерируем флешсообщение и обновляем страницу
                         */
                        Yii::app()->user->setFlash('recoveryMessage', Yii::t('user',"Please check your email. An instructions was sent to your email address."));
                        $this->refresh();
                    }
                }
                /**
                 * Рендерим форму восстановления пароля
                 */
                $this->render('recovery', array('form' => $form));
            }
        }
    }

}
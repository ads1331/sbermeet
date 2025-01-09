import requests
import telebot
import time
import threading
import pymysql
import datetime

import threading
from bs4 import BeautifulSoup as b

API_KEY = 'Key'

connection = pymysql.connect(host='localhost',
                             user='root',
                             password='',
                             database='sbermeet',
                             cursorclass=pymysql.cursors.DictCursor)





bot = telebot.TeleBot(API_KEY)
global usery
global userok
userok = False







@bot.message_handler(commands=['help'])
def help_message(message):

    help_text = """
    Привет! Я бот.
    Вот список доступных команд:
    /start - Начать общение с ботом
    /help - Получить список доступных команд
    /login - авторизация в профиль
    /event - ближайшие мероприятия
    /myev - мои ближайшие мероприятия 
    /shop - просмотреть товары
    /myorders - мои заказы
    /token - введите токен мероприятия для получения баллов
    """
    bot.send_message(message.chat.id, help_text)

state = 1

@bot.message_handler(commands=['login'])
def login(message):

    if userok == False:
        # Переменная, определяющая состояние: 1 - ожидается ввод логина, 2 - ожидается ввод пароля
        state = 1
        # Отправляем запрос логина
        bot.send_message(message.chat.id, "Введите логин:")

        # Переменная для хранения данных пользователя
        user = None

        @bot.message_handler(func=lambda message: True)
        def handle_message(message):
            global state, user, userok
            if state == 1:
                # Введенный логин
                login = message.text
                # Выполняем запрос к базе данных для проверки логина
                with connection.cursor() as cursor:
                    sql = "SELECT * FROM users WHERE login = %s"
                    cursor.execute(sql, (login,))
                    user = cursor.fetchone()
                    if user:
                        # Если логин найден, переходим к запросу пароля
                        state = 2
                        bot.send_message(message.chat.id, "Введите пароль:")
                    else:
                        bot.send_message(message.chat.id, "Пользователь с таким логином не найден.")
            elif state == 2:
                # Введенный пароль
                password = message.text
                if user and user['password'] == password:
                    bot.send_message(message.chat.id, "Вы успешно вошли.")
                    usery = user['id']
                    userok = True
                    return 0
                else:
                    bot.send_message(message.chat.id, "Неправильный пароль или логин.")
                    state = 2
                    return 0






cached_events = None

# Функция для получения ближайших событий
def get_nearest_events():
    # Получаем текущую дату и время
    current_time = datetime.datetime.now()

    # Формируем SQL-запрос для выборки 5 ближайших событий
    sql = "SELECT * FROM events WHERE date >= %s ORDER BY date LIMIT 5"

    # Выполняем запрос
    with connection.cursor() as cursor:
        cursor.execute(sql, (current_time,))
        events = cursor.fetchall()

    return events

@bot.message_handler(commands=['event'])
def event(message):
    global cached_events
    bot.send_message(message.chat.id, "Ближайшие мероприятия:")
    # Получаем ближайшие события
    events = get_nearest_events()
    # Отправляем сообщение с информацией о событиях
    if events:
        for event in events:
            event_name = event['title']
            event_date = event['date']
            bot.send_message(message.chat.id, f"Название: {event_name} \n "
                                              f"Описание: {event['description']} \n"
                                              f"Дата: {event_date}")
    else:
        bot.send_message(message.chat.id, "Нет ближайших событий.")

    # Обновляем кеш событий
    cached_events = events




@bot.message_handler(commands=['myev'])
def myev(message):
    global userok,usery


    if userok == False:
        bot.send_message(message.chat.id,"Вы не авторизованы, пройдите авторизацию /login")
    elif userok == True:
        usery = user['id']
        bot.send_message(message.chat.id, "выши мероприятия")
        current_time = datetime.datetime.now()
        sql = "SELECT * FROM events WHERE visitor_id = %s"
        with connection.cursor() as cursor:
            cursor.execute(sql, (usery,))
            user_events = cursor.fetchall()
        if user_events:
            for event in user_events:
                event_name = event['title']
                event_date = event['date']
                bot.send_message(message.chat.id, f"Название: {event_name} \n "
                                                  f"Описание: {event['description']} \n"
                                                  f"Дата: {event_date}")
        else:
            bot.send_message(message.chat.id, "У вас нет ближайших мероприятий.")




cached_shop = None

# Функция для получения ближайших событий
def get_nearest_shop():
    # Получаем текущую дату и время
    current_time = datetime.datetime.now()

    # Формируем SQL-запрос для выборки 5 ближайших событий
    sql = "SELECT * FROM shops WHERE name >= %s LIMIT 5"

    # Выполняем запрос
    with connection.cursor() as cursor:
        cursor.execute(sql, (current_time,))
        events = cursor.fetchall()

    return events

@bot.message_handler(commands=['shop'])
def event(message):
    global cached_shop
    bot.send_message(message.chat.id, "Наши товары:")
    # Получаем ближайшие события
    shopss = get_nearest_shop()
    # Отправляем сообщение с информацией о событиях
    if shopss:
        for event in shopss:
            event_name = event['name']
            event_date = event['type']
            bot.send_message(message.chat.id, f"Название: {event['name']}\n"
                             f"Описание: {event['description']}\n"
                             f"Тип: {event['type']}\n"
                             )
    else:
        bot.send_message(message.chat.id, "Нет товаров в лавке.")

    # Обновляем кеш событий
    cached_shop = shopss




@bot.message_handler(commands=['myorders'])
def myev(message):
    global userok,usery


    if userok == False:
        bot.send_message(message.chat.id,"Вы не авторизованы, пройдите авторизацию /login")
    elif userok == True:
        usery = user['id']
        bot.send_message(message.chat.id, "Ваши товыры")
        current_time = datetime.datetime.now()
        sql = "SELECT * FROM orders WHERE user_id = %s"
        with connection.cursor() as cursor:
            cursor.execute(sql, (usery,))
            user_events = cursor.fetchall()
        if user_events:
            for event in user_events:
                event_name = event['item']
                event_date = event['date']
                bot.send_message(message.chat.id, f"Название: {event_name} \n "
                                              f"вещь: {event['item']} \n"
                                              f"место доставки: {event['place']} \n"
                                              f"размер: {event['size']} \n"
                                              f"тип: {event_date}\n"
                                                f"статус заказа: {event['status']} \n")
        else:
            bot.send_message(message.chat.id, "У вас нет заказов.")


@bot.message_handler(commands=['start'])
def hello(message):
    ct = time.strftime("%H", time.localtime())
    current_time = int(ct)
    ti = ""
    if current_time >= 5 and current_time < 13:
        ti = "Доброе утро,"
    elif current_time >= 13 and current_time < 18:
        ti = "Добрый день,"
    elif current_time >= 18 and current_time <= 24:
        ti = "Добрый вечер"
    else:
        ti = "Доброй ночи"

    global userok, usery

    if userok == False:
        bot.send_message(message.chat.id, "Вы не авторизованы, пройдите авторизацию /login")
    elif userok == True:
        bot.send_message(message.chat.id, f"{ti} {message.from_user.username}, можете обратиться в помощник /help")

@bot.message_handler(commands=['token'])
def handle_token_command(message):
    if not userok:
        bot.send_message(message.chat.id, "Вы не авторизованы, пройдите авторизацию /login")
        return

    bot.send_message(message.chat.id, "Введите токен:")

    # Register the handle_token function with usery as an argument
    bot.register_next_step_handler(message, lambda msg: handle_token(msg, user['id']))

def handle_token(message, usery):
    token = message.text

    sql = "SELECT * FROM events WHERE visitor_id = %s AND location = %s"
    with connection.cursor() as cursor:
        cursor.execute(sql, (usery, token))
        user_event = cursor.fetchone()

    if user_event:
        bot.send_message(message.chat.id, f"Добро пожаловать на мероприятие {user_event['title']} \n"
                                          f"за это мероприятие вы получите {user_event['points']} баллов\n")
    else:
        bot.send_message(message.chat.id, "По такому токену нет мероприятия.")
        
bot.polling()

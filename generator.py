import random
import string
import requests
import json
import time
import os


def main():
    print("Loading...")
    with open('config.json') as json_file:
        config = json.load(json_file)
    username = config['username']
    password = config['password']
    processed = 0
    good = 0
    startTime = time.time()
    print("Starting generator...")
    while(True):
        code = getInternetCode()
        data = checkCode(code)
        badge = data["badge"]
        extra = data["extra"]
        if (badge != 'BAD'):
            if (extra == 0 or extra >= 40):
                status = sendCode(username, password, code, badge, extra)
                if status == 'GOOD':
                    good+=1
        processed+=1
        if (processed%10 == 0):
            print("Processsed: {}. Good: {}. Time: {}".format(processed, good, "{:.2f} min.".format((time.time()-startTime)/60)))


def sendCode(username, password, code, badge, extra):
    try:
        postData = {
            'username': username,
            'password': password,
            'code': code,
            'shop': "DOMINOS",
            'owner': username,
            'badge': badge,
            'status': "VACANT",
            'extra': extra
            }
        response = requests.post('https://beardcoder.herokuapp.com/addcode.php', data = postData)
        return(response.text)
    except BaseException:
        time.sleep(1)
        print("Crash with beardcoder webserver!")
        return('BAD')
    


def checkCode(code):
    try:
        postData = {'provider': "Dominos", 'code': code}
        response = requests.post('https://fe.dominospizza.ru/api/ShoppingCart/validate-promotion', json = postData)
        response = json.loads(response.text)

        if 'message' in response:
            if  response['message'] == 'INVALIDSTORE':
                return({'badge': 'Add Pepperoni', 'extra': -1})
        else:
            if 'promotionDescription' in response['content']:
                if response['content']['promotionDescription'].find('средняя пицца в подарок') != -1:
                    return({'badge': 'Free Pizza', 'extra': -1})
                if response['content']['promotionDescription'].find('порция куриных крыльев') != -1:
                    return({'badge': 'Add Chicken', 'extra': -1})
            else:
                discount = int(response['content']['promotionDiscount'])
                return({'badge': 'Discount', 'extra': discount})
        return({'badge': 'BAD', 'extra': -1})
    except BaseException:
        time.sleep(1)
        print("Crash with code webserver!")
        return({'badge': 'BAD', 'extra': -1})

def getOfflineCode(N = 8, alpha = "ABCDEF0123456789"):
    return(''.join(random.SystemRandom().choice(alpha) for _ in range(N)))


def getInternetCode():
    return('7DA4D393')
    try:
        postData = json.loads('{"lenBlock":8,"countBlock":1,"prefix":"","pstfix":"","num":true,"sym":false,"symExp":false,"upEng":true,"lwEng":false,"upRus":false,"lwRus":false,"rejectRepeat":false,"rejectTwins":false,"rejectSymbols":true,"rejSymb":"GHIJKLMNOPQRSTUVWXYZ","countKey":1,"hash":null,"expFormat":"txt"}')
        response = requests.post('https://api.pswrd.getcode.xyz/getcode', json = postData)
        return json.loads(response.text)[0]['key']
    except BaseException:
        print("Crash with code webserver!")
        time.sleep(1)
        return "BAD_CODE"


if __name__ == '__main__':
    main()
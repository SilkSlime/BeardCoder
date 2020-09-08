import requests
import json
import time
import os

def getCode(mode = 'internet'):
    try:
        postData = json.loads('{"lenBlock":8,"countBlock":1,"prefix":"","pstfix":"","num":true,"sym":false,"symExp":false,"upEng":true,"lwEng":false,"upRus":false,"lwRus":false,"rejectRepeat":false,"rejectTwins":false,"rejectSymbols":true,"rejSymb":"GHIJKLMNOPQRSTUVWXYZ","countKey":1,"hash":null,"expFormat":"txt"}')
        response = requests.post('https://api.pswrd.getcode.xyz/getcode', json = postData)
        return json.loads(response.text)[0]['key']
    except BaseException:
        stats['CRASHES']+=1;
        print("----<CRASH! Code Cunt!>----")
        return "BAD0CODE"
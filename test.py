import requests
import json
import time
import os
        
def main():
    username = "silkslime";
    password = "7549567788";
    postData = {
        'username': username,
        'password': password,
        'code': 'TEST FdROM PTHON 2',
        'shop': "TESTSHOP",
        'owner': username,
        'badge': "BADGE",
        'status': "VACANT",
        'extra': 'EXTRA'
        }
    response = requests.post('https://beardcoder.herokuapp.com/addcode.php', data = postData)
    print(response.text)
    
    
main()
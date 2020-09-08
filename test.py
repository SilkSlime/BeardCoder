import requests
import json
import time
import os
        
def main():
    print("Hi")
    postData = {'provider': "Dominos", 'code': '123123'}
    response = requests.post('https://beardcoder.herokuapp.com/addcode.php', data = postData)
    print(response)
    print(response.text)
    
    
main()
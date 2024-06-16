import asyncio
from TodayApiGet import get_riot_auth_tokens
from TodayApiGet import getaccjson
from TodayApiGet import get_skin_details



username1 = 'lov1nGAMD'
password1 = 'MisakaMikoto2333'
entitlements_token, access_token, user_id = asyncio.run(get_riot_auth_tokens(username1, password1))
data = getaccjson(entitlements_token, access_token, user_id)
offers = data['SkinsPanelLayout']['SingleItemOffers']
uid1 = offers[0]
uid2 = offers[1]
uid3 = offers[2]
uid4 = offers[3]
json_get = get_skin_details(uid1, uid2, uid3, uid4)
print(json_get)

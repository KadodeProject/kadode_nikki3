
import sys
import connectDB as db

from_php = sys.argv
user_id=from_php[1]

rows=db.get_all_diaries_from_user(user_id)



print("user_id:{0}".format(from_php[1]))
print("終了")
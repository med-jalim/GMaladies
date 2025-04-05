import pandas as pd
import requests

# جلب البيانات من PHP API
response = requests.get("http://localhost/php/gmaladies/api/patient_api.php?column=&value=")
data = response.json()

# تحويل البيانات إلى DataFrame
df = pd.DataFrame(data)

# تحليل عدد المرضى حسب الجنس
print(df.loc())


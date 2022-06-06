# 开始时间：2022/6/5 16:20
import pandas as pd
import numpy as np
"""url = 'https://raw.githubusercontent.com/justmarkham/DAT8/master/data/u.user'
occupation = pd.read_csv(url,sep='|')
print(occupation.dtypes)
occupation.to_csv('./user.csv')"""
users = pd.read_csv('./user.csv',index_col='user_id',usecols=['user_id','age','gender','occupation','zip_code'])
#print(users.head(25))  What is the age with least occurrence

#print(users.shape)

#print(users.tail(10))   See the last 10 entries

print(users.shape[0])  #What is the number of observations in the dataset

print(users.columns)  #Print the name of all the columns.

print(users.index)   #How is the dataset indexed


print(users.info())  #What is the data type of each column?
print(users.dtypes)  #What is the data type of each column?

print(users.occupation) #Print only the occupation column

print(users.occupation.value_counts().count()) #How many different occupations are in this dataset?
print(users.occupation.nunique())  #How many different occupations are in this dataset?
print(users.occupation.unique())   #Which different occupations are in this dataset


print(users.occupation.value_counts(ascending=False).head(1).index[0]) #What is the most frequent occupation

print(users.describe()) #Summarize the DataFrame.

print(users.describe(include='all'))  #Summarize all the columns

print(users.occupation.describe())          #Summarize only the occupation column

print(round(users.age.mean())) #What is the mean age of users


print(users.age.sort_values(ascending= True).head(1)) #What is the age with least occurrence
print(users.age.value_counts().tail())    #What is the age with least occurrence
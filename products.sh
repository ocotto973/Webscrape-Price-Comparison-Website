#!/bin/bash
if [ $1 = "bestbuy.txt" ]
then
	file1="$1"
	file2="$2"
else
	file1="$2"
	file2="$1"
fi

iter=1 #1 if first time entering into table, 2 if it is updating
while :
do
	#Iterate through each line in the file
	#file 1
	while read -r link ; do
    	#Skip lines without a link in the second column
   	if [ -n "$link" ]; then
        	wget -O i.html "$link"
		java -jar tagsoup-1.2.1.jar --files i.html
		rm i.html
		python3 parser.py i.xhtml 1 "$iter"
		rm i.xhtml
    	fi
	done < "$file1"
	#file 2
	while read -r link ; do
        #Skip lines without a link in the second column
        if [ -n "$link" ]; then
                wget -O i.html "$link"
                java -jar tagsoup-1.2.1.jar --files i.html
                rm i.html
                python3 parser.py i.xhtml 2 "$iter"
                rm i.xhtml
        fi
        done < "$file2"
	iter=2
	sleep $((6 * 3600))
done


arg=$*
if [ "$arg" == "start" ]; then
  cd /root
  ./rfid.py &
elif [ "$arg" == "stop" ]; then
  jobidWrap=`ps -ef | grep py | grep odcsss | sed -e "s/ r.*$//"`
  jobidRead=`ps -ef | grep rfidRead | sed -e "s/ r.*$//"`
  kill -9 $jobidWrap $jobidRead
else
  echo Invalid argument!
fi
